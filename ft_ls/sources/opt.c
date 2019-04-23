/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   opt.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 12:27:59 by malallai          #+#    #+#             */
/*   Updated: 2019/04/23 12:20:10 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_opt		*init_opt(void)
{
	t_opt	*opt;

	opt = malloc(sizeof(t_opt *) * 4);
	opt->error = 0;
	opt->flag = 0;
	opt->flags = ft_strdup("lRartsfG1");
	opt->main = new_folder(NULL);
	opt->print = 0;
	return (opt);
}
