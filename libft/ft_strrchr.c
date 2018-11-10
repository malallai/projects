/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strrchr.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 15:36:06 by malallai          #+#    #+#             */
/*   Updated: 2018/11/10 15:38:24 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strrchr(const char *s, int c)
{
	char ch;
	char *str;
	char *last;

	ch = (unsigned char)c;
	str = (char*)s;
	while (*str++)
		if (*str == ch)
			last = str;
	return (last);
}
