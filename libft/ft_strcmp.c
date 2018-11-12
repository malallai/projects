/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strcmp.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/11 15:21:04 by malallai          #+#    #+#             */
/*   Updated: 2018/11/12 17:42:46 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int		ft_strcmp(const char *s1, const char *s2)
{
	char *t_s1;
	char *t_s2;

	if (!s1 || !s2)
		return (0);
	t_s1 = (char*)s1;
	t_s2 = (char*)s2;
	while (*t_s1 && *t_s2 && *t_s1 == *t_s2)
	{
		t_s1++;
		t_s2++;
	}
	return (*t_s1 - *t_s2);
}
