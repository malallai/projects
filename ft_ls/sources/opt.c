/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   opt.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 12:27:59 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 17:39:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_opt		*init_opt(void)
{
	t_opt	*opt;

	opt = malloc(sizeof(t_opt *) * 4);
	opt->error = 0;
	opt->flag = 0;
	opt->flags = ft_strdup("lRarts");
	opt->main = new_folder(NULL);
	return (opt);
}
